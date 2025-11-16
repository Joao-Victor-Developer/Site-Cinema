import { Component, OnInit } from "@angular/core";
import { ActivatedRoute } from "@angular/router";
import { MoviesService } from "../services/movies.service";
import { DomSanitizer, SafeResourceUrl } from "@angular/platform-browser";

@Component({
  selector: "app-movie-details",
  templateUrl: "./movie-details.component.html",
  styleUrls: ["./movie-details.component.scss"],
})
export class MovieDetailsComponent implements OnInit {
  movie: any = null;
  trailerKey: string | null = null;
  backdrop: string = "";
  loading = true;
  safeTrailerUrl: SafeResourceUrl = "";

  constructor(
    private sanitizer: DomSanitizer,
    private route: ActivatedRoute,
    private movies: MoviesService
  ) {}

  ngOnInit(): void {
    const id = Number(this.route.snapshot.paramMap.get("id"));

    this.movies.getMovieDetails(id).subscribe((movie) => {
      this.movie = movie;
      this.backdrop = `https://image.tmdb.org/t/p/original${movie.backdrop_path}`;

      // 2 — Depois que carregou o filme, carregar vídeos
      this.movies.getMovieVideos(id).subscribe((res: any) => {
        // Encontrar trailer, teaser ou clip
        const trailer =
          res.results.find(
            (v: any) => v.type === "Trailer" && v.site === "YouTube"
          ) ||
          res.results.find(
            (v: any) => v.type === "Teaser" && v.site === "YouTube"
          ) ||
          res.results.find(
            (v: any) => v.type === "Clip" && v.site === "YouTube"
          );

        if (trailer) {
          this.trailerKey = trailer.key;

          // *** AQUI ESTÁ A PARTE QUE FALTAVA ***
          this.safeTrailerUrl = this.sanitizer.bypassSecurityTrustResourceUrl(
            `https://www.youtube.com/embed/${this.trailerKey}`
          );
        }

        this.loading = false;
      });
    });
  }
}
