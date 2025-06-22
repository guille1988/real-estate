import { UserInterface } from '@/Types/App/Interfaces/UserInterface';

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: UserInterface;
    };
};
