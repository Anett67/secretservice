import $ from 'jquery'

const country = $('#missions_country')
const contact = $('#missions_Contact')
const target = $('#missions_Target')
const agent = $('#missions_agent')
const specialty = $('#missions_specialty')
const hideout = $('#missions_Hideout')

const disableTargetsOfAgentsNationality = agents => {

    let agentCountryIds = [];

    agents.forEach(agentId => {
        for(let option of agent.children('option[value=' + agentId +']')){
            agentCountryIds.push(option.getAttribute('country-id'))
        }
    })

    for(let target of target.children('option')){
        
        if(agentCountryIds.includes(target.getAttribute('country-id'))){
            target.setAttribute('disabled', 'disabled')
            target.selected = false
        }else{
            target.removeAttribute('disabled')
        }
    }
}

const disableAgentsOfTargetsNationality = targets => {

    let targetCountryIds = [];

    targets.forEach(targetId => {
        for(let option of target.children('option[value=' + targetId +']')){
            targetCountryIds.push(option.getAttribute('country-id'))
        }
    })

    for(let agent of agent.children('option')){
        
        if(targetCountryIds.includes(agent.getAttribute('country-id'))){
            agent.setAttribute('disabled', 'disabled')
            agent.selected = false
        }else{
            agent.removeAttribute('disabled')
        }
    }
}

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
 disableTargetsOfAgentsNationality(agent.val())
 disableAgentsOfTargetsNationality(target.val())

country.on('change', () => {
    disableContactsOfOtherCountries(country.val())
    disableHideoutsOfOtherCountries(country.val())
});

specialty.on('change', () => {
    
});

agent.on('change', () => {
    disableTargetsOfAgentsNationality(agent.val())
});

target.on('change', () => {
    disableAgentsOfTargetsNationality(target.val())
});