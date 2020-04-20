<template>
	<div id="dash">
		<navbar></navbar>
		<slot></slot>
	</div>
</template>

<script>
import navbar from '../components/Navbar'
export default {
	name: 'dash',
	components: {
		navbar
	}
}
</script>

<style>

</style>