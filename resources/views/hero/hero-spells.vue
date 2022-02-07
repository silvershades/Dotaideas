<script>
export default {
    name: "hero-spells",
    data: function () {
        return {
            loading: true,
            current_spell: {},
            selected_spell: 'Q',
            spells: [],
            spell_Q: {},
            spell_W: {},
            spell_E: {},
            spell_R: {},
            spell_D: {},
            spell_F: {},
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
            axios.get('/api/hero-spells/' + id)
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
                case 'Q': {
                    this.current_spell = this.spell_Q;
                    this.selected_spell = 'Q';
                    break;
                }
                case 'W': {
                    this.current_spell = this.spell_W;
                    this.selected_spell = 'W';
                    break;
                }
                case 'E': {
                    this.current_spell = this.spell_E;
                    this.selected_spell = 'E';
                    break;
                }
                case 'R': {
                    this.current_spell = this.spell_R;
                    this.selected_spell = 'R';
                    break;
                }
                case 'D': {
                    this.current_spell = this.spell_D;
                    this.selected_spell = 'D';
                    break;
                }
                case 'F': {
                    this.current_spell = this.spell_F;
                    this.selected_spell = 'F';
                    break;
                }
            }

        },
        asingSpells() {
            for (var i = 0; i < this.spells.length; i++) {
                let hotkey = this.spells[i].hotkey;
                switch (hotkey) {
                    case 'Q': {
                        this.spell_Q = this.spells[i];
                        break;
                    }
                    case 'W': {
                        this.spell_W = this.spells[i];
                        break;
                    }
                    case 'E': {
                        this.spell_E = this.spells[i];
                        break;
                    }
                    case 'R': {
                        this.spell_R = this.spells[i];
                        break;
                    }
                    case 'D': {
                        this.spell_D = this.spells[i];
                        break;
                    }
                    case 'F': {
                        this.spell_F = this.spells[i];
                        break;
                    }
                    default: {
                        // console.log(spell);
                    }

                }
                this.changeCurrentSpell('Q')
            }
        }
    },
    computed: {}
}
</script>

<style scoped>

</style>
