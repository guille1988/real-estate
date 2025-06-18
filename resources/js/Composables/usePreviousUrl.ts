export function usePreviousUrl(baseUrl: string, fragment?: string): string {
    const url: URL = new URL(baseUrl, window.location.origin);
    let currentUrl = window.location.href;

    if (fragment) {
        currentUrl = currentUrl + fragment;
    }

    url.searchParams.set('previous_url', currentUrl);

    return url.toString();
}
