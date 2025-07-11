import { queryParams, type QueryParams } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\ContactController::__invoke
* @see app/Http/Controllers/ContactController.php:13
* @route '/contact'
*/
const ContactController = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: ContactController.url(options),
    method: 'get',
})

ContactController.definition = {
    methods: ['get','head'],
    url: '/contact',
}

/**
* @see \App\Http\Controllers\ContactController::__invoke
* @see app/Http/Controllers/ContactController.php:13
* @route '/contact'
*/
ContactController.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return ContactController.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ContactController::__invoke
* @see app/Http/Controllers/ContactController.php:13
* @route '/contact'
*/
ContactController.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: ContactController.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ContactController::__invoke
* @see app/Http/Controllers/ContactController.php:13
* @route '/contact'
*/
ContactController.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: ContactController.url(options),
    method: 'head',
})

export default ContactController