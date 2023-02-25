console.log('custom.js loading...')

document.querySelectorAll('input[name="AGREE_TO_TERMS"]').forEach((e) => {
	e.checked = true
})

document.querySelectorAll('.mc4wp-form-fields').forEach((e) => {
	e.querySelector('.form-line').classList.add('hidden')
})

const $privacyPolicy = document.getElementById('privacy_policy_field')

if ($privacyPolicy) {
	$privacyPolicy.classList.add('hidden')
}

console.log('custom.js loaded')