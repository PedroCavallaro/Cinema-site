//moviePage
export interface modalItens {
    movieName:  string,
    seatsChose: HTMLDivElement,
    showSeats: HTMLDivElement,
    seatsMainContainer: HTMLDivElement,
    moviePoster: HTMLImageElement,
    ticketAmount:HTMLTitleElement,
    closeModal:HTMLButtonElement,
    finishButton: HTMLButtonElement
}
export interface mainPageItens{
    roomButton: NodeListOf<Element>,
    today: HTMLTitleElement,
    homeBAnchor: HTMLAnchorElement,
    imgAncor: HTMLAnchorElement,
    movieImg: HTMLImageElement

}
export interface roomElements{
    roomTime:Element,
    roomNodes: NodeListOf<ChildNode>,
    roomPick:Element
}

export interface tmbdApiResponse {
    adult: string,
    backdrop_path:string,
    belongs_to_collection: {
        backdrop_path:string,
        id:number,
        name:string,
        poster_path: string
    },
    budget: number,
    genres:[
        {
            id:number,
            name: string
        }
    ],
    homepage: string,
    id:number,
    imdb_id: string,
    original_language: string,
    original_title: string,
    overview: string,
    popularity: number,
    poster_path: string,
    production_companies:[
        {
            id: number,
            logo_path: string,
            name: string,
            origin_country: string
        }
    ],
    production_countries: [
        {
            iso_3166_1: string,
            name: string
        }
    ],
    release_date: string,
    revenue: number,
    runtime:number,
    spoken_languages:[
        {
            english_name:string,
            iso_639_1: string,
            name: string
        }
    ],
    status: string,
    tagline: string,
    title: string,
    video: boolean,
    vote_average: number,
    vote_count: number

}
