/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';

/**
 * Internal dependencies
 */
import json from '../block.json';
import { __ } from '@wordpress/i18n';
import Autocomplete from './autocomplete';
import { useBlockProps } from '@wordpress/block-editor';
import apiFetch from '@wordpress/api-fetch';
import { useState } from '@wordpress/element';

import './editor.scss';
import './style.scss';

// Destructure the json file to get the name and settings for the block
// For more information on how this works, see: https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/Destructuring_assignment
const { name, textdomain } = json;

// Register the block
registerBlockType( name, {
    attributes: {
        value: {
            type: 'string'
        },
        isSelected: {
            type: 'boolean'
        },
        resortData: {
            type: 'object'
        }
    },
    edit: ({ attributes, setAttributes }) => {
        const [ suggestions, setSuggestions ] = useState([]);
        const [ isSelected, setIsSelected ] = useState( attributes.selected ?? false );

        const loadResortSuggestions = async( search ) => {
            return await apiFetch({ path: `/fnugg/v1/suggest-autocomplete?q=${search}` }).then( ( resp ) => {
                return resp.result.map( ( item, index ) => {
                    return { value: item.name, label: item.name, id: index };
                });
            });
        };

        const loadResortData = async( search ) => {
            return await apiFetch({ path: `/fnugg/v1/search?q=${search}` }).then( ( resp ) => {
                return ( 0 < resp.hits.total ) ? resp.hits.hits[0]._source : [];
            });
        };

        const onChangeValue = async( val ) => {
            const match = suggestions.find( ({ value }) => value === val );
            let attributesPayload = { value: val };
            if ( match ) {
                setSuggestions([]);
                setIsSelected( true );
                attributesPayload = { ...attributesPayload, selected: true, resortData: await loadResortData( val ) };
            } else {
                setSuggestions( await loadResortSuggestions( val ) );
            }
            setAttributes( attributesPayload );
            console.log( attributesPayload );
        };

        const { value } = attributes;

        return (
            <div {...useBlockProps()}>
                <h4>{__( 'Select a Resort', textdomain )}</h4>

                <Autocomplete
                    label='Attribute label'
                    value={attributes.value}
                    onChange={onChangeValue}
                    options={suggestions}
                />
            </div>
        );
    },

    save: ({ attributes }) => {
        const formatDate = ( dateStr ) => {
            let d = new Date( dateStr );
            return ( '0' + d.getDate() ).slice( -2 ) + '-' + ( '0' + ( d.getMonth() + 1 ) ).slice( -2 ) + '-' +
                d.getFullYear() + ' ' + ( '0' + d.getHours() ).slice( -2 ) + ':' + ( '0' + d.getMinutes() ).slice( -2 );
        };

        return ( <article {...useBlockProps.save()}>
            <header className="fnugg-header">
                {attributes.resortData.name}
            </header>
            <main className="fnugg-resort-image">
                <img src={attributes.resortData.images.image_1_1_l} />
                <div className="fnugg-resort-image__desc">
                    <div className="">{attributes.resortData.conditions.combined.top.condition_description}</div>
                    <div className="">{__( 'Opdaterd', textdomain ) + ': ' + formatDate( attributes.resortData.last_updated )}</div>
                </div>
            </main>
            <footer className="fnugg-conditions-grid">
                <div className="fnugg-conditions-grid__cell">A</div>
                <div className="fnugg-conditions-grid__cell fnugg-temperature">
                    {attributes.resortData.conditions.combined.top.temperature.value + '°C'}
                </div>
                <div className="fnugg-conditions-grid__cell">C</div>
                <div className="fnugg-conditions-grid__cell">D</div>
            </footer>
        </article> );
    }
});