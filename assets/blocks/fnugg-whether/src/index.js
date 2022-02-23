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
import Resort from './Resort';
import { useBlockProps } from '@wordpress/block-editor';
import { loadResortSuggestions, loadResortData } from './api';
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
        const debounce = ( func, delay ) => {
            let timer;
            return function() {
                let self = this;
                let args = arguments;
                clearTimeout( timer );
                timer = setTimeout( () => {
                    func.apply( self, args );
                }, delay );
            };
        };

        const onChangeValue = async( val ) => {
            const match = suggestions.find( ({ value }) => value === val );
            let attributesPayload = { value: val };
            if ( match ) {
                setSuggestions([]);
                setIsSelected( true );
                attributesPayload = { ...attributesPayload, selected: true, resortData: await loadResortData( val ) };
            } else {
                debounce( async() => setSuggestions( await loadResortSuggestions( val ) ), 1000 )();
            }
            setAttributes( attributesPayload );
            console.log( attributesPayload );
        };

        const { value } = attributes;

        return (
            <div {...useBlockProps()}>
                <Autocomplete
                    label='Select a Resort'
                    placeholder='Just start typing...'
                    value={attributes.value}
                    onChange={onChangeValue}
                    options={suggestions}
                />
                <Resort data={attributes?.resortData}/>
            </div>
        );
    },

    save: ({ attributes }) => {
        return <Resort data={attributes.resortData} />;
    }
});
