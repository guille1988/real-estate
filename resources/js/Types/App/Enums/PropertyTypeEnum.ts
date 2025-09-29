export enum PropertyTypeEnum {
    APARTMENT = 'apartment',
    HOUSE = 'house',
    LOFT = 'loft',
    VILLA = 'villa',
}

export const PropertyTypeColors: Record<PropertyTypeEnum, string> = {
    [PropertyTypeEnum.APARTMENT]: 'green',
    [PropertyTypeEnum.HOUSE]: 'indigo',
    [PropertyTypeEnum.LOFT]: 'yellow',
    [PropertyTypeEnum.VILLA]: 'purple',
};
