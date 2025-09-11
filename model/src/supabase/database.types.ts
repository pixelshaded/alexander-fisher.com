import { DatabaseTypes } from '../generated/supabase/database.types';

const SCHEMA_NAME = 'public';

export const Tables: {
  [K in keyof DatabaseTypes[typeof SCHEMA_NAME]['Tables']]: K;
} = {
  blacklisted_ips: 'blacklisted_ips',
  categories: 'categories',
  category: 'category',
  galleries: 'galleries',
  images: 'images',
  project: 'project',
  projects: 'projects',
  roles: 'roles',
  user_role: 'user_role',
  users: 'users',
};

type RowOf<T extends keyof DatabaseTypes[typeof SCHEMA_NAME]['Tables']> =
  DatabaseTypes[typeof SCHEMA_NAME]['Tables'][T]['Row'];

export type BlacklistedIp = RowOf<typeof Tables.blacklisted_ips>;
export type Category = RowOf<typeof Tables.categories>;
export type CategoryTable = RowOf<typeof Tables.category>;
export type Gallery = RowOf<typeof Tables.galleries>;
export type Image = RowOf<typeof Tables.images>;
export type Project = RowOf<typeof Tables.project>;
export type Projects = RowOf<typeof Tables.projects>;
export type Role = RowOf<typeof Tables.roles>;
export type UserRole = RowOf<typeof Tables.user_role>;
export type User = RowOf<typeof Tables.users>;
