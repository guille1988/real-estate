import { UserInterface } from '@/Types/App/Interfaces';

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: UserInterface;
    };
};
