class PlateType {
    private id: bigint;
    private name: string;
    private value: number;

    constructor(id: bigint, name: string, value: number) {
        this.id = id;
        this.name = name;
        this.value = value;
    }
}

export default PlateType
