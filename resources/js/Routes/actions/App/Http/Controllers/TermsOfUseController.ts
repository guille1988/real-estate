import { queryParams, type QueryParams } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\TermsOfUseController::__invoke
* @see app/Http/Controllers/TermsOfUseController.php:12
* @route '/terms-of-use'
*/
const TermsOfUseController = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: TermsOfUseController.url(options),
    method: 'get',
})

TermsOfUseController.definition = {
    methods: ['get','head'],
    url: '/terms-of-use',
}

/**
* @see \App\Http\Controllers\TermsOfUseController::__invoke
* @see app/Http/Controllers/TermsOfUseController.php:12
* @route '/terms-of-use'
*/
TermsOfUseController.url = (options?: { query?: QueryParams, mergeQuery?: QueryParams }) => {
    return TermsOfUseController.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\TermsOfUseController::__invoke
* @see app/Http/Controllers/TermsOfUseController.php:12
* @route '/terms-of-use'
*/
TermsOfUseController.get = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'get',
} => ({
    url: TermsOfUseController.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\TermsOfUseController::__invoke
* @see app/Http/Controllers/TermsOfUseController.php:12
* @route '/terms-of-use'
*/
TermsOfUseController.head = (options?: { query?: QueryParams, mergeQuery?: QueryParams }): {
    url: string,
    method: 'head',
} => ({
    url: TermsOfUseController.url(options),
    method: 'head',
})

export default TermsOfUseController