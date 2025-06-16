import { EmitSearchFilterEventsType } from './EmitSearchFilterEventsType';

export type EmitSearchFilterFunctionType = {
    <T extends keyof EmitSearchFilterEventsType>(
        event: T,
        ...args: EmitSearchFilterEventsType[T]
    ): void;
};
