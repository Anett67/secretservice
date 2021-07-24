import $ from 'jquery'

const country = $('#missions_country')
const contact = $('#missions_Contact')
const target = $('#missions_Target')
const agent = $('#missions_agent')
const specialty = $('#missions_specialty')
const hideout = $('#missions_Hideout')

const adjustValuesToCountry = country => {
    
    disableOfOtherCountries(country.val())
}

const disableOfOtherCountries = country => {

    for(let contact of contact.children('option')){
        if(contact.getAttribute('country-id') !== country){
            contact.setAttribute('disabled', 'disabled')
            contact.selected = false
        }else{
            contact.removeAttribute('disabled')
        }
    }
}

adjustValuesToCountry(country)

country.on('change', () => {
    adjustValuesToCountry(country)
});

specialty.on('change', () => {
    
});

contact.on('change', () => {
    
});

agent.on('change', () => {
    
});

hideout.on('change', () => {
    
});

target.on('change', () => {
    
});