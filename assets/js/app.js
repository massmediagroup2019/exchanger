require('../css/app.scss');
require('bootstrap/scss/bootstrap.scss')
const Routing = require('./routing')
const $ = require('jquery');

$(() => {

    $('#update-rates-btn').click(async () => {
        await $.post(Routing.generate('update_rates'))
        window.location.reload()
    })

    const listNode = $('.list')

    listNode.on('click', '.edit-rate button', (event) => {
        $(event.currentTarget).parents('.rate-field').addClass('editing');
    })

    listNode.on('click', '.save-rate button', (event) => {saveRate(event)})
    listNode.on('keypress', '.rate-input', (event) => {
        if(event.which === 13) {
            saveRate(event)
        }
    })

    listNode.on('click', '.delete-rate', async (event) => {
        $(event.currentTarget).prop('disabled', true)
        const rowNode = $(event.currentTarget).parents('.rate-row')
        const currency = rowNode.data('currency')
        await $.ajax({
            url: Routing.generate('delete_rate', {currency}),
            type: 'DELETE',
        })

        rowNode.remove()
    })

    async function saveRate(event) {
        const rowNode = $(event.currentTarget).parents('.rate-row')
        const inputNode = rowNode.find('.rate-input')

        rowNode.find('.save-rate button').prop('disabled', true)

        const currency = rowNode.data('currency')
        const rateValue = inputNode.val()

        const response = await $.post(Routing.generate('change_rate', {currency}), {rate: rateValue})
        rowNode.html(response)
    }
})
