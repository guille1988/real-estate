export function usePreviousUrl(baseUrl: string, fragment: string = ''): string {
    const url: URL = new URL(baseUrl, window.location.origin);

    // We take the current URL with no fragments to avoid overlapping.
    const currentUrl: string = window.location.href.split('#')[0];

    url.searchParams.set('previous_url', currentUrl + fragment);

    return url.toString();
}
