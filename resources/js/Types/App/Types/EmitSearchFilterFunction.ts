import { EmitSearchFilterEvents } from './EmitSearchFilterEvents';

export type EmitSearchFilterFunction = {
    <T extends keyof EmitSearchFilterEvents>(
        event: T,
        ...args: EmitSearchFilterEvents[T]
    ): void;
};
