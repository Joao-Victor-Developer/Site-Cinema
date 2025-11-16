import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-nearby-cinemas',
  templateUrl: './nearby-cinemas.component.html',
  styleUrls: ['./nearby-cinemas.component.scss']
})
export class NearbyCinemasComponent implements OnInit {
  cinemas: any[] = [];
  loading = true;

  // coordenadas (alteráveis)
  userLat =  -23.55052;   // default São Paulo (fallback)
  userLon = -46.633308;
  radius = 20000; // metros

  showManual = false;

  ngOnInit(): void {
    this.tryGeolocation();
  }

  tryGeolocation() {
    this.loading = true;
    this.showManual = false;

    if (!navigator.geolocation) {
      this.showManual = true;
      this.loading = false;
      return;
    }

    navigator.geolocation.getCurrentPosition(
      (pos) => {
        this.userLat = pos.coords.latitude;
        this.userLon = pos.coords.longitude;
        this.loadNearbyCinemas();
      },
      (err) => {
        // se usuário negar ou ocorrer erro, mostrar fallback manual
        this.showManual = true;
        this.loading = false;
      },
      { timeout: 8000 }
    );
  }

  retryLocation() {
    this.tryGeolocation();
  }

  searchManually() {
    // validação básica
    if (!this.userLat || !this.userLon) {
      alert('Informe latitude e longitude válidas.');
      return;
    }
    this.loading = true;
    this.cinemas = [];
    this.loadNearbyCinemas();
  }

  loadNearbyCinemas() {
    const radius = this.radius || 5000;

    const query = `
      [out:json];
      node["amenity"="cinema"](around:${radius},${this.userLat},${this.userLon});
      out;
    `;

    fetch('https://overpass-api.de/api/interpreter', {
      method: 'POST',
      body: query
    })
      .then(res => res.json())
      .then(data => {
        if (!data || !data.elements || data.elements.length === 0) {
          this.cinemas = [];
          this.loading = false;
          return;
        }

        this.cinemas = data.elements.map((e: any) => {
          const name = (e.tags && (e.tags.name || e.tags['name:pt'])) || 'Cinema Desconhecido';
          const address = e.tags ? (
            e.tags['addr:street'] ? `${e.tags['addr:street']} ${e.tags['addr:housenumber'] || ''}` :
            (e.tags['addr:full'] || 'Endereço não informado')
          ) : 'Endereço não informado';

          return {
            name,
            lat: e.lat,
            lon: e.lon,
            address,
            distance: this.calculateDistanceKm(e.lat, e.lon)
          };
        });

        // ordenar por distância
        this.cinemas.sort((a,b) => Number(a.distance) - Number(b.distance));
        this.loading = false;
      })
      .catch(err => {
        console.error('Overpass error', err);
        this.cinemas = [];
        this.loading = false;
      });
  }

  calculateDistanceKm(lat2: number, lon2: number) {
    const R = 6371; // km
    const lat1 = this.userLat;
    const lon1 = this.userLon;
    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLon = (lon2 - lon1) * Math.PI / 180;

    const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
              Math.cos(lat1 * Math.PI/180) * Math.cos(lat2 * Math.PI/180) *
              Math.sin(dLon/2) * Math.sin(dLon/2);

    const km = R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    return km.toFixed(2);
  }
}
