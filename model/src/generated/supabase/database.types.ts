export type Json =
  | string
  | number
  | boolean
  | null
  | { [key: string]: Json | undefined }
  | Json[]

export type DatabaseTypes = {
  // Allows to automatically instantiate createClient with right options
  // instead of createClient<DatabaseTypes, { PostgrestVersion: 'XX' }>(URL, KEY)
  __InternalSupabase: {
    PostgrestVersion: "13.0.5"
  }
  public: {
    Tables: {
      blacklisted_ips: {
        Row: {
          address: string
          attempts: number
          id: number
        }
        Insert: {
          address: string
          attempts: number
          id?: number
        }
        Update: {
          address?: string
          attempts?: number
          id?: number
        }
        Relationships: []
      }
      categories: {
        Row: {
          description: string
          id: number
          slug: string
          subtitle: string
          title: string
        }
        Insert: {
          description: string
          id?: number
          slug: string
          subtitle: string
          title: string
        }
        Update: {
          description?: string
          id?: number
          slug?: string
          subtitle?: string
          title?: string
        }
        Relationships: []
      }
      category: {
        Row: {
          description: string
          id: number
          slug: string
          subtitle: string
          title: string
        }
        Insert: {
          description: string
          id?: number
          slug: string
          subtitle: string
          title: string
        }
        Update: {
          description?: string
          id?: number
          slug?: string
          subtitle?: string
          title?: string
        }
        Relationships: []
      }
      galleries: {
        Row: {
          cover_id: number | null
          id: number
          slug: string
          title: string
        }
        Insert: {
          cover_id?: number | null
          id?: number
          slug: string
          title: string
        }
        Update: {
          cover_id?: number | null
          id?: number
          slug?: string
          title?: string
        }
        Relationships: [
          {
            foreignKeyName: "fk_f70e6eb7922726e9"
            columns: ["cover_id"]
            isOneToOne: false
            referencedRelation: "images"
            referencedColumns: ["id"]
          },
        ]
      }
      images: {
        Row: {
          alt: string
          filename: string
          gallery_id: number | null
          id: number
        }
        Insert: {
          alt: string
          filename: string
          gallery_id?: number | null
          id?: number
        }
        Update: {
          alt?: string
          filename?: string
          gallery_id?: number | null
          id?: number
        }
        Relationships: [
          {
            foreignKeyName: "fk_e01fbe6a4e7af8f"
            columns: ["gallery_id"]
            isOneToOne: false
            referencedRelation: "galleries"
            referencedColumns: ["id"]
          },
        ]
      }
      project: {
        Row: {
          category_id: number | null
          content: string
          id: number
          intro: string
          slug: string
          subcontent: string
          subtitle: string
          tagline: string
          title: string
        }
        Insert: {
          category_id?: number | null
          content: string
          id?: number
          intro: string
          slug: string
          subcontent: string
          subtitle: string
          tagline: string
          title: string
        }
        Update: {
          category_id?: number | null
          content?: string
          id?: number
          intro?: string
          slug?: string
          subcontent?: string
          subtitle?: string
          tagline?: string
          title?: string
        }
        Relationships: [
          {
            foreignKeyName: "fk_e00ee97212469de2"
            columns: ["category_id"]
            isOneToOne: false
            referencedRelation: "category"
            referencedColumns: ["id"]
          },
        ]
      }
      projects: {
        Row: {
          category_id: number | null
          content: string
          gallery_id: number | null
          id: number
          intro: string
          slug: string
          subcontent: string
          subtitle: string
          tagline: string
          title: string
        }
        Insert: {
          category_id?: number | null
          content: string
          gallery_id?: number | null
          id?: number
          intro: string
          slug: string
          subcontent: string
          subtitle: string
          tagline: string
          title: string
        }
        Update: {
          category_id?: number | null
          content?: string
          gallery_id?: number | null
          id?: number
          intro?: string
          slug?: string
          subcontent?: string
          subtitle?: string
          tagline?: string
          title?: string
        }
        Relationships: [
          {
            foreignKeyName: "fk_5c93b3a412469de2"
            columns: ["category_id"]
            isOneToOne: false
            referencedRelation: "categories"
            referencedColumns: ["id"]
          },
          {
            foreignKeyName: "fk_5c93b3a44e7af8f"
            columns: ["gallery_id"]
            isOneToOne: false
            referencedRelation: "galleries"
            referencedColumns: ["id"]
          },
        ]
      }
      roles: {
        Row: {
          id: number
          name: string
          role: string
        }
        Insert: {
          id?: number
          name: string
          role: string
        }
        Update: {
          id?: number
          name?: string
          role?: string
        }
        Relationships: []
      }
      user_role: {
        Row: {
          role_id: number
          user_id: number
        }
        Insert: {
          role_id: number
          user_id: number
        }
        Update: {
          role_id?: number
          user_id?: number
        }
        Relationships: [
          {
            foreignKeyName: "fk_2de8c6a3a76ed395"
            columns: ["user_id"]
            isOneToOne: false
            referencedRelation: "users"
            referencedColumns: ["id"]
          },
          {
            foreignKeyName: "fk_2de8c6a3d60322ac"
            columns: ["role_id"]
            isOneToOne: false
            referencedRelation: "roles"
            referencedColumns: ["id"]
          },
        ]
      }
      users: {
        Row: {
          email: string
          id: number
          isactive: boolean
          password: string
          salt: string
          username: string
        }
        Insert: {
          email: string
          id?: number
          isactive: boolean
          password: string
          salt: string
          username: string
        }
        Update: {
          email?: string
          id?: number
          isactive?: boolean
          password?: string
          salt?: string
          username?: string
        }
        Relationships: []
      }
    }
    Views: {
      [_ in never]: never
    }
    Functions: {
      [_ in never]: never
    }
    Enums: {
      [_ in never]: never
    }
    CompositeTypes: {
      [_ in never]: never
    }
  }
}

type DatabaseWithoutInternals = Omit<DatabaseTypes, "__InternalSupabase">

type DefaultSchema = DatabaseWithoutInternals[Extract<keyof DatabaseTypes, "public">]

export type Tables<
  DefaultSchemaTableNameOrOptions extends
    | keyof (DefaultSchema["Tables"] & DefaultSchema["Views"])
    | { schema: keyof DatabaseWithoutInternals },
  TableName extends DefaultSchemaTableNameOrOptions extends {
    schema: keyof DatabaseWithoutInternals
  }
    ? keyof (DatabaseWithoutInternals[DefaultSchemaTableNameOrOptions["schema"]]["Tables"] &
        DatabaseWithoutInternals[DefaultSchemaTableNameOrOptions["schema"]]["Views"])
    : never = never,
> = DefaultSchemaTableNameOrOptions extends {
  schema: keyof DatabaseWithoutInternals
}
  ? (DatabaseWithoutInternals[DefaultSchemaTableNameOrOptions["schema"]]["Tables"] &
      DatabaseWithoutInternals[DefaultSchemaTableNameOrOptions["schema"]]["Views"])[TableName] extends {
      Row: infer R
    }
    ? R
    : never
  : DefaultSchemaTableNameOrOptions extends keyof (DefaultSchema["Tables"] &
        DefaultSchema["Views"])
    ? (DefaultSchema["Tables"] &
        DefaultSchema["Views"])[DefaultSchemaTableNameOrOptions] extends {
        Row: infer R
      }
      ? R
      : never
    : never

export type TablesInsert<
  DefaultSchemaTableNameOrOptions extends
    | keyof DefaultSchema["Tables"]
    | { schema: keyof DatabaseWithoutInternals },
  TableName extends DefaultSchemaTableNameOrOptions extends {
    schema: keyof DatabaseWithoutInternals
  }
    ? keyof DatabaseWithoutInternals[DefaultSchemaTableNameOrOptions["schema"]]["Tables"]
    : never = never,
> = DefaultSchemaTableNameOrOptions extends {
  schema: keyof DatabaseWithoutInternals
}
  ? DatabaseWithoutInternals[DefaultSchemaTableNameOrOptions["schema"]]["Tables"][TableName] extends {
      Insert: infer I
    }
    ? I
    : never
  : DefaultSchemaTableNameOrOptions extends keyof DefaultSchema["Tables"]
    ? DefaultSchema["Tables"][DefaultSchemaTableNameOrOptions] extends {
        Insert: infer I
      }
      ? I
      : never
    : never

export type TablesUpdate<
  DefaultSchemaTableNameOrOptions extends
    | keyof DefaultSchema["Tables"]
    | { schema: keyof DatabaseWithoutInternals },
  TableName extends DefaultSchemaTableNameOrOptions extends {
    schema: keyof DatabaseWithoutInternals
  }
    ? keyof DatabaseWithoutInternals[DefaultSchemaTableNameOrOptions["schema"]]["Tables"]
    : never = never,
> = DefaultSchemaTableNameOrOptions extends {
  schema: keyof DatabaseWithoutInternals
}
  ? DatabaseWithoutInternals[DefaultSchemaTableNameOrOptions["schema"]]["Tables"][TableName] extends {
      Update: infer U
    }
    ? U
    : never
  : DefaultSchemaTableNameOrOptions extends keyof DefaultSchema["Tables"]
    ? DefaultSchema["Tables"][DefaultSchemaTableNameOrOptions] extends {
        Update: infer U
      }
      ? U
      : never
    : never

export type Enums<
  DefaultSchemaEnumNameOrOptions extends
    | keyof DefaultSchema["Enums"]
    | { schema: keyof DatabaseWithoutInternals },
  EnumName extends DefaultSchemaEnumNameOrOptions extends {
    schema: keyof DatabaseWithoutInternals
  }
    ? keyof DatabaseWithoutInternals[DefaultSchemaEnumNameOrOptions["schema"]]["Enums"]
    : never = never,
> = DefaultSchemaEnumNameOrOptions extends {
  schema: keyof DatabaseWithoutInternals
}
  ? DatabaseWithoutInternals[DefaultSchemaEnumNameOrOptions["schema"]]["Enums"][EnumName]
  : DefaultSchemaEnumNameOrOptions extends keyof DefaultSchema["Enums"]
    ? DefaultSchema["Enums"][DefaultSchemaEnumNameOrOptions]
    : never

export type CompositeTypes<
  PublicCompositeTypeNameOrOptions extends
    | keyof DefaultSchema["CompositeTypes"]
    | { schema: keyof DatabaseWithoutInternals },
  CompositeTypeName extends PublicCompositeTypeNameOrOptions extends {
    schema: keyof DatabaseWithoutInternals
  }
    ? keyof DatabaseWithoutInternals[PublicCompositeTypeNameOrOptions["schema"]]["CompositeTypes"]
    : never = never,
> = PublicCompositeTypeNameOrOptions extends {
  schema: keyof DatabaseWithoutInternals
}
  ? DatabaseWithoutInternals[PublicCompositeTypeNameOrOptions["schema"]]["CompositeTypes"][CompositeTypeName]
  : PublicCompositeTypeNameOrOptions extends keyof DefaultSchema["CompositeTypes"]
    ? DefaultSchema["CompositeTypes"][PublicCompositeTypeNameOrOptions]
    : never

export const Constants = {
  public: {
    Enums: {},
  },
} as const
