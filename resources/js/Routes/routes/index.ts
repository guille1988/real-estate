import { queryParams, type QueryParams } from './../wayfinder'
/**
* @see \App\Http\Controllers\HomeController::home
* @see app/Http/Controllers/HomeController.php:21
* @route '/'
*/
export const home = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: home.url(options),
    method: 'get',
})

home.definition = {
    methods: ['get','head'],
    url: '/',
}

/**
* @see \App\Http\Controllers\HomeController::home
* @see app/Http/Controllers/HomeController.php:21
* @route '/'
*/
home.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return home.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\HomeController::home
* @see app/Http/Controllers/HomeController.php:21
* @route '/'
*/
home.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: home.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\HomeController::home
* @see app/Http/Controllers/HomeController.php:21
* @route '/'
*/
home.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: home.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\AboutController::about
* @see app/Http/Controllers/AboutController.php:13
* @route '/about'
*/
export const about = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: about.url(options),
    method: 'get',
})

about.definition = {
    methods: ['get','head'],
    url: '/about',
}

/**
* @see \App\Http\Controllers\AboutController::about
* @see app/Http/Controllers/AboutController.php:13
* @route '/about'
*/
about.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return about.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AboutController::about
* @see app/Http/Controllers/AboutController.php:13
* @route '/about'
*/
about.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: about.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AboutController::about
* @see app/Http/Controllers/AboutController.php:13
* @route '/about'
*/
about.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: about.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\ContactController::contact
* @see app/Http/Controllers/ContactController.php:13
* @route '/contact'
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
    url: '/contact',
}

/**
* @see \App\Http\Controllers\ContactController::contact
* @see app/Http/Controllers/ContactController.php:13
* @route '/contact'
*/
contact.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return contact.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ContactController::contact
* @see app/Http/Controllers/ContactController.php:13
* @route '/contact'
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
* @see app/Http/Controllers/ContactController.php:13
* @route '/contact'
*/
contact.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: contact.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\ServiceController::services
* @see app/Http/Controllers/ServiceController.php:13
* @route '/services'
*/
export const services = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: services.url(options),
    method: 'get',
})

services.definition = {
    methods: ['get','head'],
    url: '/services',
}

/**
* @see \App\Http\Controllers\ServiceController::services
* @see app/Http/Controllers/ServiceController.php:13
* @route '/services'
*/
services.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return services.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ServiceController::services
* @see app/Http/Controllers/ServiceController.php:13
* @route '/services'
*/
services.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: services.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ServiceController::services
* @see app/Http/Controllers/ServiceController.php:13
* @route '/services'
*/
services.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: services.url(options),
    method: 'head',
})

