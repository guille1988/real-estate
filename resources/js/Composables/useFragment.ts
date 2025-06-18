export function useFragment(baseUrl: string, fragment?: string) {
    const url: URL = new URL(baseUrl, window.location.origin);

    if (fragment) {
        url.searchParams.set('fragment', fragment);
    }

    return url.toString();
}
