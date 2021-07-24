import $ from 'jquery'

const country = $('#missions_country')
const contact = $('#missions_Contact')
const target = $('#missions_Target')
const agent = $('#missions_agent')
const specialty = $('#missions_specialty')
const hideout = $('#missions_Hideout')


const disableContactsOfOtherCountries = country => {

    for(let contact of contact.children('option')){
        if(contact.getAttribute('country-id') !== country){
            contact.setAttribute('disabled', 'disabled')
            contact.selected = false
        }else{
            contact.removeAttribute('disabled')
        }
    }
}

const disableHideoutsOfOtherCountries = country => {

    for(let hideout of hideout.children('option')){
        if(hideout.getAttribute('country-id') !== country){
            hideout.setAttribute('disabled', 'disabled')
            hideout.selected = false
        }else{
            hideout.removeAttribute('disabled')
        }
    }
}

 disableContactsOfOtherCountries(country.val())
 disableHideoutsOfOtherCountries(country.val())

country.on('change', () => {
    disableContactsOfOtherCountries(country.val())
    disableHideoutsOfOtherCountries(hideout.val())
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