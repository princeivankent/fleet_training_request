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
import Home from './views/Home'

export default {
  name: 'App',
  components: {Header,Home}
}
</script>
