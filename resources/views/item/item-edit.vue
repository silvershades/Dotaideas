<script>
export default {
  name: "item-edit",
  data: function () {
    return {
      loading: false,
      loading_hero: false,
      publishing: false,
      publish_modal: false,
      ajax_errors: {},
      ajax_success: '',
      exception: false,
      post_created_id: '',

      bonus_strength: 0,
      bonus_agility: 0,
      bonus_intelligence: 0,
      item_mod_key: '',
      item_mod_value: '',
      recipe_mod_value: '',
      spell_mod_name: '',
      spell_mod_value: '',
      errors: {
        hero: [],
        spells: [],
        description: [],
      },
      errors_debug: '',
      ditem: {
        name: '',
        is_active: 0,
        image_show: '',
        description: '',
        lore: '',
        item_type_id: 1,
        gold: 1500,
        item_shop_id: 1,
        bonus_strength: 2,
        bonus_agility: 2,
        bonus_intelligence: 2,
        roles_armor: 0,
        roles_damage: 2,
        roles_utility: 1,
        roles_support: 3,
        roles_siege: 1,
        roles_heal: 3,
        roles_mana: 1,
        roles_disable: 1,
        roles_resistance: 0,

        damage_pure: 0,
        damage_physical: 3,
        damage_magical: 1,
        modifiers: [],
        recipe: []
      },
      selected_spell: '1',
      current_spell: {},
      images: {
        item: '',
        spell_1: '',
        spell_2: '',
        spell_3: '',
      },
      spell_1: {
        name: '',
        placeholder: 'Enter 1 ability name here...',
        hotkey: '1',

        image_show: '',
        description: '',
        spell_type: 1,
        spell_target: 1,
        spell_damage_type: 1,
        pierces_bkb: 1,
        dispellable: 1,
        breakable: 1,
        blocked_by_linkens: 1,
        cast_while_rooted: 1,
        mod_by_aghanims_scepter: 0,
        mod_by_aghanims_scepter_desc: '',
        mod_by_aghanims_shard: 0,
        mod_by_aghanims_shard_desc: '',
        created_by_aghanims_scepter: 0,
        created_by_aghanims_shard: 0,
        manacost: '',
        cooldown: '',
        spell_attributes: []
      },
      spell_2: {
        name: '',
        placeholder: 'Enter 2 ability name here...',
        hotkey: '2',

        image_show: '',
        description: '',
        spell_type: 2,
        spell_target: 1,
        spell_damage_type: 1,
        pierces_bkb: 1,
        dispellable: 1,
        breakable: 1,
        blocked_by_linkens: 1,
        cast_while_rooted: 1,
        mod_by_aghanims_scepter: 0,
        mod_by_aghanims_scepter_desc: '',
        mod_by_aghanims_shard: 0,
        mod_by_aghanims_shard_desc: '',
        created_by_aghanims_scepter: 0,
        created_by_aghanims_shard: 0,
        manacost: '',
        cooldown: '',
        spell_attributes: []
      },
      spell_3: {
        name: '',
        placeholder: 'Enter 3 ability name here...',
        hotkey: '3',

        image_show: '',
        description: '',
        spell_type: 2,
        spell_target: 1,
        spell_damage_type: 1,
        pierces_bkb: 1,
        dispellable: 1,
        breakable: 1,
        blocked_by_linkens: 1,
        cast_while_rooted: 1,
        mod_by_aghanims_scepter: 0,
        mod_by_aghanims_scepter_desc: '',
        mod_by_aghanims_shard: 0,
        mod_by_aghanims_shard_desc: '',
        created_by_aghanims_scepter: 0,
        created_by_aghanims_shard: 0,
        manacost: '',
        cooldown: '',
        spell_attributes: []
      },
      spells: []
    }
  },
  mounted() {
    this.getItem();
    this.changeCurrentSpell('1')
  },
  methods: {
    getItem() {
      var obj = this;
      let id = window.location.href.split('/').pop();
      this.loading = true;
      axios.get('/api/get-item/' + id)
          .then((response) => {
            this.ditem = response.data.data[0];
            this.getSpells();
            this.loading = false;
          })
          .catch(function (error) {
            obj.loading = false;
            console.log(error)
          });
    },
    getSpells() {
      var obj = this;
      this.loading = true;
      axios.get('/api/item-spells/' + this.ditem.id)
          .then((response) => {
            this.spells = response.data.data;
            // console.log(this.spells)
            this.asingSpells();
            this.loading = false;
          })
          .catch(function (error) {
            obj.loading = false;
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
    addSpellModifier: function (value) {
      if (this.spell_mod_name != '' && this.spell_mod_value != '') {

        let new_modifier = {
          name: this.spell_mod_name,
          value: this.spell_mod_value
        }
        switch (this.selected_spell) {
          case '1': {
            this.spell_1.spell_attributes.unshift(new_modifier);
            break;
          }
          case '2': {
            this.spell_2.spell_attributes.unshift(new_modifier);
            break;
          }
          case '3': {
            this.spell_3.spell_attributes.unshift(new_modifier);
            break;
          }

        }
        this.spell_mod_name = '';
        this.spell_mod_value = '';
      }
    },
    addItemModifier: function (value) {
      if (this.item_mod_value != '') {

        let new_modifier = {
          value: this.item_mod_value
        }
        this.ditem.modifiers.unshift(new_modifier);

        this.item_mod_value = '';
      }
    },
    addRecipeModifier: function (value) {
      if (this.recipe_mod_value != '') {

        let new_modifier = {
          item: this.recipe_mod_value
        }
        this.ditem.recipe.unshift(new_modifier);
        this.recipe_mod_value = '';
      }
    },
    deleteSpellModifier: function (that) {
      Vue.delete(this.current_spell.spell_attributes, that);
    },
    deleteItemModifier: function (that) {
      Vue.delete(this.ditem.modifiers, that);
    },
    deleteRecipeModifier: function (that) {
      Vue.delete(this.ditem.recipe, that);
    },
    onFileChangeItem: function (payload) {
      const file = payload.target.files[0];
      this.images.item = file;
      this.ditem.img_is_uploaded = 1;
      this.ditem.img_path = URL.createObjectURL(file);
      URL.revokeObjectURL(file);
    },
    onFileChange: function (payload) {
      const file = payload.target.files[0];
      switch (this.current_spell.hotkey) {
        case '1': {
          this.images.spell_1 = file;
          break;
        }
        case '2': {
          this.images.spell_2 = file;
          break;
        }
        case '3': {
          this.images.spell_3 = file;
          break;
        }

      }
      this.current_spell.img_is_uploaded = 1;
      this.current_spell.img_path = URL.createObjectURL(file);
      URL.revokeObjectURL(file);
    },
    checkDataForSubmit: function (event) {
      // this.errors.hero = [];
      // this.errors.spells = [];
      // this.errors.description = [];
      //
      // //HERO VALIDATION
      // if (!this.ditem.name) {
      //   this.errors.hero.push("Hero's name is required.");
      // }
      // if (this.ditem.name.length > 40) {
      //   this.errors.hero.push("Name is too long.");
      // }
      // if (!this.ditem.image.length) {
      //   this.errors.hero.push("Hero's portrait is required.");
      // }
      // //SPELLS VALIDATION
      // if (!this.spell_1.name.length) {
      //   this.errors.spells.push("Q spell's name is required.");
      // }
      // if (!this.spell_2.name.length) {
      //   this.errors.spells.push("W spell's name is required.");
      // }
      // if (!this.spell_3.name.length) {
      //   this.errors.spells.push("E spell's name is required.");
      // }
      //
      // if (!this.spell_1.description.length) {
      //   this.errors.spells.push("Q spell's description is required.");
      // }
      // if (!this.spell_2.description.length) {
      //   this.errors.spells.push("W spell's description is required.");
      // }
      // if (!this.spell_3.description.length) {
      //   this.errors.spells.push("E spell's description is required.");
      // }
      //
      // //TALENTS VALIDATION
      //
      // //TEXTS VALIDATION
      // if (!this.ditem.description.length) {
      //   this.errors.description.push('Description is required.');
      // }
      //
      // if (!this.errors.spells.length  && !this.errors.description.length) {
      //
      //   this.errors.spells = [];
      //   this.errors.description = [];
      //
      //   this.startPublish();
      //   //enviar
      // } else {
      //   //bypass
      //   this.startPublish();
      // }
    },
   asingSpells() {
    // console.log(this.spells)
    for (var i = 0; i < this.spells.length; i++) {
      let hotkey = this.spells[i].hotkey;
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
        default: {

        }
      }
      this.changeCurrentSpell('1')
    }
  },
    startPublish: function (event) {
      this.ajax_errors = {};
      this.publish_modal = true;
    },
    presetPostNotActive: function (event) {
      this.ditem.is_active = 0;
      this.initiateAjaxPost();
    },
    presetPostActive: function (event) {
      this.ditem.is_active = 1;
      this.initiateAjaxPost();
    },
    initiateAjaxPost: function (event) {

      this.publishing = true;
      let obj = this;

      const formData = new FormData();
      formData.append('item', JSON.stringify(this.ditem));
      formData.append('spell_1', JSON.stringify(this.spell_1));
      formData.append('spell_2', JSON.stringify(this.spell_2));
      formData.append('spell_3', JSON.stringify(this.spell_3));

      formData.append('image_item', this.images.item);
      formData.append('image_spell_1', this.images.spell_1);
      formData.append('image_spell_2', this.images.spell_2);
      formData.append('image_spell_3', this.images.spell_3);


      // console.log(this.images);


      axios.post('/api/item-update', formData, {'content-type': 'multipart/form-data'})
          .then((response) => {
            this.publishing = false;
            if (response.data.status === 'success') {
              this.ajax_success = response.data.msg;
              this.post_created_id = '/post/item/' + response.data.post_id;
            } else if (response.data.status === 'error') {
              this.ajax_errors = response.data.errors;
              if (response.data.msg === 'Error Throwable' || response.data.msg === 'Error Exception') {
                this.exception = true;
              }
            }
            console.log(response.data);
          })
          .catch(function (error) {
            obj.publishing = false;
            // this.ajax_errors = ['Conection Error. Please try again.']
            // this.ajax_errors = error;
            // console.log(error);
          });

    }

  },
  computed: {}
}
</script>

<style scoped>

</style>
