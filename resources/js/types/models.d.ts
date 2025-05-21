declare namespace Model {
    export type Page = {
      title: string
      meta_title?: string
      meta_description?: string
      medias: {} | null
  
    }
    export type News = {
      id: number
      title: string
      blocks?: Array<Block> | null
    }
    export type Program = {
      title: string
      meta_title?: string
      meta_description?: string
      blocks?: Array<Block> | null
      medias: {} | null
    }
    
    export type Block ={
        editor_name: string
        position: number
        type: string
        content: any | null
        childs: Array<Block> | null
        medias: any | null
    }
    export type MenuLinks ={
      title?: string | null
      related: Model.Page | null
    }
    export type Media = {
        alt?: string
        caption?: string
        height: number
        src?: string
        video?: string
        width: number
      }
    
      export type MediaWithRoles = {
        default?: Media
        desktop?: Media
        mobile?: Media
        tablet?: Media
      }
  }