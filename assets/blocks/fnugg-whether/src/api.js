import apiFetch from '@wordpress/api-fetch';

export async function loadResortSuggestions( search ) {
    return await apiFetch({ path: `/fnugg/v1/suggest-autocomplete?q=${search}` }).then( ( resp ) => {
        return resp.result.map( ( item, index ) => {
            return { value: item.name, label: item.name, id: index };
        });
    });
};

export async function loadResortData( search ) {
    return await apiFetch({ path: `/fnugg/v1/search?q=${search}` }).then( ( resp ) => {
        return ( 0 < resp.hits.total ) ? resp.hits.hits[0]._source : [];
    });
};

export default { loadResortSuggestions, loadResortData };
