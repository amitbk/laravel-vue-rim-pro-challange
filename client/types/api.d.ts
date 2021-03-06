
export interface MetApiResponse {
  benchmark: number
  status: 'success' | 'failure'
  query: {
    options: Record<string, any>
    params: Record<string, any>
  }
  paginate?: {
    current_page: number
    first_item: number
    last_item: number
    last_page: number
    pages: Array<number>
    per_page: number
    total: number
  }
  data: any
}

export interface User {
  name: string
  job: string
  email: string
  phone: string
  avatar: string
}

export interface Experience {
  id: number
  company: string
  role: string
  date_start: string
  date_end: string
}

export interface Tag {
  id: number
  title: string
  tag_type_id: number
}
export interface TagType {
  index: number
  title: string
}

export type Users = Array<User>
export type Experiences = Array<Experience>
export type Tags = Array<Tag>
export type TagTypes = Array<TagType>
