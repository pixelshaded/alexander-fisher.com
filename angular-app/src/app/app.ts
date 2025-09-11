import { ChangeDetectionStrategy, Component, OnInit, signal } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { Category } from '../../../model/src/supabase/database.types';
import { SupabaseService } from '../../../model/src/supabase/supabase.service';

@Component({
  selector: 'app-root',
  imports: [RouterOutlet],
  templateUrl: './app.html',
  styleUrl: './app.scss',
  changeDetection: ChangeDetectionStrategy.OnPush,
})
export class App implements OnInit {
  protected readonly categories = signal<Category[]>([]);

  constructor(private supabaseService: SupabaseService) {}

  async ngOnInit() {
    const categories = await this.supabaseService.getCategories();
    this.categories.set(categories);
  }
}
