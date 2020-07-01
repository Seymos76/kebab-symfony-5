class Menu {
    private id: bigint;
    private name: string;
    private promo: string;
    private price: number;
    private icon: string;
    private cat: string;

    constructor(id: bigint, name: string, promo: string, price: number, icon: string, cat: string) {
        this.id = id;
        this.name = name;
        this.promo = promo;
        this.price = price;
        this.icon = icon;
        this.cat = cat;
    }
}

export default Menu
