<template>
    <v-expansion-panel-content
        hide-actions
    >
        <v-layout
            slot="header"
            align-center
            row
            spacer
        >
            <v-flex xs4 sm2 md1>
                <v-avatar
                    slot="activator"
                    size="36px"
                >
                    <img
                    v-if="brasao"
                    :src="brasao"
                    alt="Avatar"
                    >
                </v-avatar>
            </v-flex>

            <v-flex sm5 md3 hidden-xs-only>
                <strong v-html="titulo"></strong>
            </v-flex>

            <v-flex no-wrap xs5 sm3>
                <strong v-html="de_ate"></strong>
            </v-flex>

            <v-flex
            v-if="descricao"
            class="grey--text"
            ellipsis
            hidden-sm-and-down
            >
            &mdash;
            {{ descricao }}
            </v-flex>
        </v-layout>

        <v-card>
            <v-divider></v-divider>
            <v-card-text v-text="descricao"></v-card-text>
        </v-card>
    </v-expansion-panel-content>
</template>
<script>
export default {
    name: 'Campeonato',
    props: ['brasao', 'titulo', 'descricao', 'de_ate'],
    data() {
        return {

        }
    }
}
</script>
