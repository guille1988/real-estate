export enum ContactMessageInquiryTypeEnum {
    BUY = 'buy',
    SELL = 'sell',
    RENT = 'rent',
    OTHER = 'other',
}

export const ContactMessageInquiryTypeColors: Record<
    ContactMessageInquiryTypeEnum,
    string
> = {
    [ContactMessageInquiryTypeEnum.BUY]: 'green',
    [ContactMessageInquiryTypeEnum.SELL]: 'indigo',
    [ContactMessageInquiryTypeEnum.RENT]: 'yellow',
    [ContactMessageInquiryTypeEnum.OTHER]: 'purple',
};
