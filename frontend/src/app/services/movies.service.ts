import { Injectable } from "@angular/core";
import { HttpClient } from "@angular/common/http";
import { map } from "rxjs/operators";
import { Observable } from "rxjs";

@Injectable({ providedIn: "root" })
export class MoviesService {
  private api = "https://api.themoviedb.org/3";
  private apiKey = "a6789226436a0e05ebccfb97932f7069";

  private IMG_BASE = "https://image.tmdb.org/t/p/";

  constructor(private http: HttpClient) {}

  private transformMovie(m: any) {
    return {
      id: m.id,
      title: m.title || m.name,
      overview: m.overview,
      poster: m.poster_path ? this.IMG_BASE + "w500" + m.poster_path : null,
      backdrop: m.backdrop_path
        ? this.IMG_BASE + "original" + m.backdrop_path
        : null,
      genres: m.genre_ids || [],
      vote_average: m.vote_average,
      release_date: m.release_date,
    };
  }

  getPopular(page: number = 1): Observable<any> {
    return this.http
      .get(`${this.api}/movie/popular?api_key=${this.apiKey}&language=pt-BR`)
      .pipe(
        map((res: any) => res.results.map((m: any) => this.transformMovie(m)))
      );
  }

  getMovieDetails(id: number): Observable<any> {
    return this.http.get(
      `${this.api}/movie/${id}?api_key=${this.apiKey}&language=pt-BR`
    );
  }

  getMovieVideos(id: number): Observable<any> {
    return this.http.get(
      `${this.api}/movie/${id}/videos?api_key=${this.apiKey}`
    );
  }

  getNowPlaying() {
    return this.http
      .get(
        `${this.api}/movie/now_playing?api_key=${this.apiKey}&language=pt-BR`
      )
      .pipe(
        map((res: any) => res.results.map((m: any) => this.transformMovie(m)))
      );
  }

  getMovie(id: number) {
    return this.http
      .get(
        `${this.api}/movie/${id}?api_key=${this.apiKey}&language=pt-BR&append_to_response=credits`
      )
      .pipe(
        map((m: any) => ({
          ...this.transformMovie(m),
          runtime: m.runtime,
          genres: m.genres.map((g: any) => g.name),
          credits: m.credits,
        }))
      );
  }

  searchMovies(query: string): Observable<any> {
    return this.http.get(
      `${this.api}/search/movie?api_key=${this.apiKey}&language=pt-BR&query=${query}`
    );
  }
}
