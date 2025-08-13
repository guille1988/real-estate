import { ErrorInterface } from '@/Types/App/Interfaces/ErrorInterface';
import { toast } from 'vue3-toastify';

export function displayErrors(errors: ErrorInterface): void {
    if (errors === undefined) return;

    const errorsToDisplay: (string | string[])[] = Object.values(errors);

    if (errorsToDisplay.length === 0) {
        return;
    }

    const firstError: string | string[] = errorsToDisplay[0];

    const message: string = Array.isArray(firstError)
        ? firstError[0]
        : firstError;

    toast.error(message);
}
