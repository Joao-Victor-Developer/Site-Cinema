import { Component } from "@angular/core";
import { MoviesService } from "../services/movies.service";

@Component({
  selector: "app-movies",
  templateUrl: "./movies.component.html",
  styleUrls: ["./movies.component.scss"],
})
export class MoviesComponent {
  popular: any[] = [];
  loading = true;
  searchQuery = "";
  page = 1;
  isSearching = false;

  constructor(private movies: MoviesService) {}

  ngOnInit() {
    this.loadPopular();
  }

  loadPopular() {
    this.loading = true;
    this.movies.getPopular(this.page).subscribe((res: any) => {
      this.popular = res.results;
      this.loading = false;
    });
  }

  search() {
    const q = this.searchQuery.trim();

    if (!q) {
      // Se a busca está vazia, volta ao catálogo normal
      this.isSearching = false;
      this.page = 1;
      this.loadPopular();
      return;
    }

    this.loading = true;
    this.isSearching = true;

    this.movies.searchMovies(q).subscribe((res: any) => {
      this.popular = res.results;
      this.loading = false;
    });
  }

  nextPage() {
    if (this.isSearching) return; // não pagina durante busca

    this.page++;
    this.loadPopular();
  }

  prevPage() {
    if (this.isSearching) return; // idem aqui

    if (this.page > 1) {
      this.page--;
      this.loadPopular();
    }
  }
}
