<template>
  <v-app style="background-color: #222D32;">
    <Header />
		<v-content dark>
			<v-container>
				<Home />
			</v-container>
		</v-content>
	</v-app>
</template>

<script>
import Header from './templates/Header'
import Home from './modules/request/Home'

export default {
  components: {Header,Home}
}
</script>

<style lang="scss" src="./styles/App.scss"></style>