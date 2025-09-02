import AboutController from '@/Routes/actions/App/Http/Controllers/AboutController';
import ContactController from '@/Routes/actions/App/Http/Controllers/ContactController';
import HomeController from '@/Routes/actions/App/Http/Controllers/HomeController';
import PropertyController from '@/Routes/actions/App/Http/Controllers/PropertyController';
import ServiceController from '@/Routes/actions/App/Http/Controllers/ServiceController';

export function useSection(section: string): string {
    const sections: Record<string, string> = {
        ['achievements']: AboutController.url(),
        ['clients']: AboutController.url(),
        ['journey']: AboutController.url(),
        ['meet-team']: AboutController.url(),
        ['navigating-experience']: AboutController.url(),
        ['values']: AboutController.url(),
        ['lets-connect']: ContactController.index().url,
        ['office-locations']: ContactController.index().url,
        ['featured-properties']: HomeController.url(),
        ['testimonials']: HomeController.url(),
        ['faq']: HomeController.url(),
        ['search-property']: PropertyController.index().url,
        ['make-it-happen']: PropertyController.index().url,
        ['elevate-experience']: ServiceController.url(),
        ['unlock-property-value']: ServiceController.url(),
        ['effortless-property-management']: ServiceController.url(),
        ['smart-investments']: ServiceController.url(),
    };

    return sections[section] + `#${section}`;
}
