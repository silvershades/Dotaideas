<script>
export default {
    name: "item-spells",
    data: function () {
        return {
            loading: true,
            current_spell: {},
            selected_spell: '1',
            spells: [],
            spell_1: {},
            spell_2: {},
            spell_3: {},

        }
    },
    mounted() {
        this.loadSpells();

    },
    methods: {
        async loadSpells() {
            await this.fetchSpells();
        },
        fetchSpells() {
            let id = window.location.href.split('/').pop();
            axios.get('/api/item-spells/' + id)
                .then((response) => {
                    this.spells = response.data.data;
                    this.asingSpells();
                    this.loading = false;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },

        changeCurrentSpell: function (value) {
            switch (value) {
                case '1': {
                    this.current_spell = this.spell_1;
                    this.selected_spell = '1';
                    break;
                }
                case '2': {
                    this.current_spell = this.spell_2;
                    this.selected_spell = '2';
                    break;
                }
                case '3': {
                    this.current_spell = this.spell_3;
                    this.selected_spell = '3';
                    break;
                }

            }

        },
        asingSpells() {
            for (var i = 0; i < this.spells.length; i++) {
                let hotkey = this.spells[i].hotkey;
                // console.log(hotkey)
                switch (hotkey) {
                    case '1': {

                        this.spell_1 = this.spells[i];
                        break;
                    }
                    case '2': {
                        this.spell_2 = this.spells[i];
                        break;
                    }
                    case '3': {
                        this.spell_3 = this.spells[i];
                        break;
                    }
                    default:{

                    }


                }
                this.changeCurrentSpell('1')
            }
        }
    },
    computed: {}
}
</script>

<style scoped>

</style>
