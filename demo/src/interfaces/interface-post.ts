export interface IPost {
  post_id: number
  post_title: string
  post_slug: string
  post_desc: string
  post_image: string
  created_at: string
  updated_at: string
}

export interface IPosts {
  data: IPost[]
}