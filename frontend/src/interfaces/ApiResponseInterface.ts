interface ApiResponseInterface {
  title: string
  description: string
  results: {
    current_page: number,
    data: {
      [key: string]: string
    }[],
    first_page_url: string,
    from: number,
    last_page: number,
    last_page_url: string,
    links: {
      [key: string]: null | string | boolean
    }[],
    next_page_url: string,
    path: string,
    per_page: number,
    prev_page_url: null,
    to: number,
    total: number
  }
}

interface ApiResponseSingleRecordInterface {
  title: string,
  description: string,
  results: {
    [key: string]: number | string | null
  }[]
}

export {
  ApiResponseInterface,
  ApiResponseSingleRecordInterface
}
