<template>
    <v-slide-y-transition mode="out-in">
        <v-layout column justify-center>
            <v-card>
                <v-container
                fluid
                grid-list-lg
                >
                    <v-layout row wrap>
                        <v-flex xs4>
                            <v-card color="blue-grey darken-2" class="white--text">
                            <v-layout row>
                                <v-flex xs5>
                                <img
                                    style="margin-left: 2%"
                                    src="https://pbs.twimg.com/profile_images/999428166107123712/jqmiGHC2_400x400.jpg"
                                    height="150px"
                                    contain
                                >
                                </v-flex>
                                <v-flex xs7>
                                <v-card-title primary-title>
                                    <div>
                                    <div class="headline">Rafael "Rakin" Knittel</div>
                                    <div>Mid-laner</div>
                                    <div>23 anos</div>
                                    </div>
                                </v-card-title>
                                </v-flex>
                            </v-layout>
                            <v-divider light></v-divider>
                            <v-card-actions class="pa-3">
                                Desempenho
                                <v-spacer></v-spacer>
                                <v-icon>star</v-icon>
                                <v-icon>star</v-icon>
                                <v-icon>star</v-icon>
                                <v-icon>star</v-icon>
                                <v-icon>star_border</v-icon>
                            </v-card-actions>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card>
        </v-layout>
    </v-slide-y-transition>
</template>
<script>
export default {
    name: 'Atletas'
}
</script>
<style scoped>

</style>

