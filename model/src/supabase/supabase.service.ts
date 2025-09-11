import { DatabaseTypes } from '../generated/supabase/database.types';
import { Category, Tables } from './database.types';
import { createClient, SupabaseClient } from '@supabase/supabase-js';

export class SupabaseService {
  readonly SUPABASE_URL = 'https://fpfwbjvfabnwhbsqcvkb.supabase.co';

  readonly SUPABASE_KEY =
    'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImZwZndianZmYWJud2hic3FjdmtiIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTc0ODM4MTAsImV4cCI6MjA3MzA1OTgxMH0.Fa1FZs79XfKXuuSziaCnGIVcik1Cfz-OQZpOA8K1BBY';

  private client: SupabaseClient<DatabaseTypes>;

  constructor() {
    this.client = this.createClient(this.SUPABASE_URL, this.SUPABASE_KEY);
  }

  createClient(url: string, key: string) {
    return createClient(url, key);
  }

  handleResponse<T>(
    response: { data: T | null; error: unknown },
    defaultData: T
  ): T {
    if (response.error) {
      throw response.error;
    }

    if (response.data) {
      return response.data;
    }

    return defaultData;
  }

  async getCategories(): Promise<Category[]> {
    const response = await this.client.from(Tables.categories).select();

    return this.handleResponse(response, []);
  }
}
