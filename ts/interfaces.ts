//moviePage
export interface modalItens {
    movieName:  string,
    seatsChose: HTMLDivElement,
    showSeats: HTMLDivElement,
    seatsMainContainer: HTMLDivElement,
    moviePoster: HTMLImageElement,
    ticketAmount:HTMLTitleElement,
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