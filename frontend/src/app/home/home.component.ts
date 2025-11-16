
import { Component, OnInit } from '@angular/core';
import { MoviesService } from '../services/movies.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {
  popular: any[] = [];
  nowPlaying: any[] = [];
  heroMovie: any = null;
  query = '';

  constructor(
    private moviesService: MoviesService,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.loadPopular();
    this.loadNowPlaying();
  }

  loadPopular() {
    this.moviesService.getPopular().subscribe((res: any) => {
      this.popular = res || [];
      if (this.popular.length) {
        this.heroMovie = this.popular[0];
      }
    }, () => { this.popular = []; });
  }

  loadNowPlaying() {
    this.moviesService.getNowPlaying().subscribe((res: any) => {
      this.nowPlaying = res || [];
    }, () => { this.nowPlaying = []; });
  }

  search() {
    // Implementar navegação para a tela de catálogo com query, ex:
    // this.router.navigate(['/movies'], { queryParams: { q: this.query } });
    console.log('search:', this.query);
  }

  openMovie(id: string | number) {
    // navega para detalhes
    // this.router.navigate(['/movie', id]);
    console.log('open movie', id);

    this.router.navigate(['movie', id]);
  }
}
