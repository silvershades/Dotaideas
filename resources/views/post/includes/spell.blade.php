<div class="w-full rounded  flex flex-col space-y-2 p-4 spell_box mb-4">
    <p class="font-semibold text-3xl">{{$spell->name}}</p>
    <div class="flex items-center justify-start space-x-4">

        <div class="radio_label_show flex   flex-col h-16 space-y-1">
            @switch($spell->spell_type_id)
                @case(1)
                @include('svgs',['svg' => 'active','classes' => 'w-6 h-6 text-primary-icon shrink-0'])
                @break
                @case(2)
                @include('svgs',['svg' => 'autocast','classes' => 'w-6 h-6 text-primary-icon shrink-0'])
                @break
                @case(3)
                @include('svgs',['svg' => 'passive','classes' => 'w-6 h-6 text-primary-icon shrink-0'])
                @break
            @endswitch
            <p class="text-sm uppercase font-semibold">{{$spell->spellType->name}}</p>
        </div>

        <div class="radio_label_show flex  flex-col h-16 space-y-1">
            @switch($spell->spell_target_id)
                @case(1)
                @include('svgs',['svg' => 'target_none','classes' => 'w-6 h-6 text-primary-icon shrink-0'])
                @break
                @case(2)
                @include('svgs',['svg' => 'target_area','classes' => 'w-6 h-6 text-primary-icon shrink-0'])
                @break
                @case(3)
                @include('svgs',['svg' => 'target_unit','classes' => 'w-6 h-6 text-primary-icon shrink-0'])
                @break
                @case(4)
                @include('svgs',['svg' => 'target_unit_or_point','classes' => 'w-6 h-6 text-primary-icon shrink-0'])
                @break
                @case(5)
                @include('svgs',['svg' => 'target_vector','classes' => 'w-6 h-6 text-primary-icon shrink-0'])
                @break
                @case(6)
                @include('svgs',['svg' => 'target_unit_with_area','classes' => 'w-6 h-6 text-primary-icon shrink-0'])
                @break

            @endswitch

            <p class="text-sm uppercase font-semibold">{{$spell->spellTarget->name}}</p>
        </div>
        <div class="radio_label_show flex flex-col h-16 space-y-1
        @switch($spell->spell_damage_type_id)
        @case(1)
                radio_label_show_none
@break
        @case(2)
                radio_label_show_pure
@break
        @case(3)
                radio_label_show_physical
@break
        @case(4)
                radio_label_show_magical
@break
        @case(5)
                radio_label_show_mix
@break
        @case(6)
                radio_label_show_hp_removal
@break
        @endswitch
                ">
            <p class="text-xs text-primary-text-muted">DAMAGE</p>
            <p class="text-sm uppercase font-semibold">{{$spell->spellDamageType->name}}</p>
        </div>
    </div>
    <p class="py-4 max-h-[300px] long_text">{{$spell->description}}</p>
    <div class="flex items-center justify-start text-sm text-center flex-wrap space-x-2 py-4">
        <div class=" flex flex-col space-y-1 @if($spell->pierces_bkb == 1) radio_label_show_on @else radio_label_show_off @endif">
            <span class="text-xs leading-none">PIERCES BKB</span>
            @if($spell->pierces_bkb == 0)
                <span class="leading-none font-semibold text-off">NO</span>
            @else
                <span class="leading-none font-semibold text-on">YES</span>
            @endif
        </div>
        <div class=" flex flex-col space-y-1 @if($spell->dispellable == 1) radio_label_show_on @else radio_label_show_off @endif">
            <span class="text-xs leading-none">DISPELLABLE</span>
            @if($spell->dispellable == 0)
                <span class="leading-none font-semibold text-off">NO</span>
            @else
                <span class="leading-none font-semibold text-on">YES</span>
            @endif
        </div>
        <div class=" flex flex-col space-y-1 @if($spell->breakable == 1) radio_label_show_on @else radio_label_show_off @endif">
            <span class="text-xs leading-none">BREAKEABLE</span>
            @if($spell->breakable == 0)
                <span class="leading-none font-semibold text-off">NO</span>
            @else
                <span class="leading-none font-semibold text-on">YES</span>
            @endif
        </div>
        <div class=" flex flex-col space-y-1 @if($spell->blocked_by_linkens == 1) radio_label_show_on @else radio_label_show_off @endif">
            <span class="text-xs leading-none">PROCS LINKENS</span>
            @if($spell->blocked_by_linkens == 0)
                <span class="leading-none font-semibold text-off">NO</span>
            @else
                <span class="leading-none font-semibold text-on">YES</span>
            @endif
        </div>
        <div class=" flex flex-col space-y-1 @if($spell->cast_while_rooted == 1) radio_label_show_on @else radio_label_show_off @endif">
            <span class="text-xs leading-none">CAST WHILE ROOTED</span>
            @if($spell->cast_while_rooted == 0)
                <span class="leading-none font-semibold text-off">NO</span>
            @else
                <span class="leading-none font-semibold text-on">YES</span>
            @endif
        </div>


    </div>
    <div class="grid gap-2 text-sm">
        <div class="space-y-2">
            @foreach($spell->spellAttributes as $attribute)
                <div class="flex items-start justify-start space-x-2">
                    <p class="text-primary-text-muted uppercase">{{ $attribute->name }}</p>
                    <p class="font-semibold uppercase">{{ $attribute->value }}</p>
                </div>
            @endforeach
        </div>

    </div>
    <div class="text-sm flex items-center justify-start space-x-10 ">
        <div class="flex items-center justify-start space-x-2 my-4">
            @include('svgs',['svg' => 'cooldown','classes' => 'w-6 h-6 rounded'])
            <p class="font-semibold">{{$spell->cooldown}}</p>
        </div>
        <div class="flex items-center justify-start space-x-2 my-4">
            <div class="gradient_mana_cost w-6 h-6 rounded"></div>
            <p class="font-semibold">{{$spell->manacost}}</p>
        </div>
    </div>
    <div class="text-sm rounded grid lg:grid-cols-2 gap-4">
        @if($spell->mod_by_aghanims_scepter == 1)
            <div class="mb-2 flex items-center justify-start w-full space-x-2 my-2">
                <div class="flex-grow  h-full">
                    <p class="font-semibold radio_label_show_aghs">Aghanim's Scepter Upgrade</p>
                    <p class="text-sm">{{$spell->mod_by_aghanims_scepter_desc}}</p>
                </div>
            </div>
        @endif
        @if($spell->mod_by_aghanims_shard == 1)
            <div class="mb-2 flex items-center justify-start w-full space-x-2 my-2">
                <div class="flex-grow h-full">
                    <p class="font-semibold radio_label_show_aghs">Aghanim's Shard Upgrade</p>
                    <p class="text-sm">{{$spell->mod_by_aghanims_shard_desc}}</p>
                </div>
            </div>
        @endif
    </div>
</div>