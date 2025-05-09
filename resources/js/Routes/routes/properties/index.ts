import { queryParams, type QueryParams } from './../../wayfinder'

/**
* @see \App\Http\Controllers\PropertyController::index
* @see app/Http/Controllers/PropertyController.php:12
* @route '/properties'
*/
export const index = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ['get','head'],
    url: '/properties',
}

/**
* @see \App\Http\Controllers\PropertyController::index
* @see app/Http/Controllers/PropertyController.php:12
* @route '/properties'
*/
index.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PropertyController::index
* @see app/Http/Controllers/PropertyController.php:12
* @route '/properties'
*/
index.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\PropertyController::index
* @see app/Http/Controllers/PropertyController.php:12
* @route '/properties'
*/
index.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\PropertyController::show
* @see app/Http/Controllers/PropertyController.php:17
* @route '/properties/{property}'
*/
export const show = (args: { property: string | number } | [property: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ['get','head'],
    url: '/properties/{property}',
}

/**
* @see \App\Http\Controllers\PropertyController::show
* @see app/Http/Controllers/PropertyController.php:17
* @route '/properties/{property}'
*/
show.url = (args: { property: string | number } | [property: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { property: args }
    }

    if (Array.isArray(args)) {
        args = {
            property: args[0],
        }
    }

    const parsedArgs = {
        property: args.property,
    }

    return show.definition.url
            .replace('{property}', parsedArgs.property.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\PropertyController::show
* @see app/Http/Controllers/PropertyController.php:17
* @route '/properties/{property}'
*/
show.get = (args: { property: string | number } | [property: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\PropertyController::show
* @see app/Http/Controllers/PropertyController.php:17
* @route '/properties/{property}'
*/
show.head = (args: { property: string | number } | [property: string | number ] | string | number, options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: show.url(args, options),
    method: 'head',
})

const properties = {
    index,
    show,
}

export default properties