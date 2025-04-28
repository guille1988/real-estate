import { queryParams, type QueryParams } from './../wayfinder'

/**
 * @see \App\Http\Controllers\ContactController::contact
 * @see app/Http/Controllers/ContactController.php:12
 * @route /contact
 */
export const contact = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: contact.url(options),
    method: 'get',
})

contact.definition = {
    methods: ['get','head'],
    url: '\/contact',
}

/**
 * @see \App\Http\Controllers\ContactController::contact
 * @see app/Http/Controllers/ContactController.php:12
 * @route /contact
 */
contact.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return contact.definition.url + queryParams(options)
}

/**
 * @see \App\Http\Controllers\ContactController::contact
 * @see app/Http/Controllers/ContactController.php:12
 * @route /contact
 */
contact.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: contact.url(options),
    method: 'get',
})

/**
 * @see \App\Http\Controllers\ContactController::contact
 * @see app/Http/Controllers/ContactController.php:12
 * @route /contact
 */
contact.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: contact.url(options),
    method: 'head',
})

export default contact