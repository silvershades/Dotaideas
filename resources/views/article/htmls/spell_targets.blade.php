<?php
$dota2heroes = \App\Models\Dota2Hero::all();
?>


<p>Spells in Dota 2 are targeted in many different ways. Here we are going to cover them all.</p>

<h2>No Target Spell</h2>
<p>Abilities with the no target requirement are immediately cast as soon as its button is pressed. Many of these abilities do not have a cast time. They cannot directly target a unit or a point. They usually affect the caster, or units around the
    caster. They can affect an area around the caster, or have a global effect.</p>
<div class="article_video">
    <video autoplay controls loop muted poster="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/abilities/slardar/slardar_slithereen_crush.jpg">
        <source type="video/webm" src="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/abilities/slardar/slardar_slithereen_crush.webm">
        <source type="video/mp4" src="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/abilities/slardar/slardar_slithereen_crush.mp4">
    </video>
</div>
<h2>Point Target Spell</h2>
<p>Point-target abilities require the caster to target a point or an area. Upon pressing the Hotkey, the cursor turns into a crosshair that determines where the ability will be cast, or in which direction it will be cast. Point targeting abilities
    can have very varying effects. For some abilities, it merely determines the direction to launch an effect, for other abilities it determines an exact point where an effect will be applied.</p>
<div class="article_video">
    <video autoplay controls loop muted poster="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/abilities/morphling/morphling_waveform.jpg">
        <source type="video/webm" src="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/abilities/morphling/morphling_waveform.webm">
        <source type="video/mp4" src="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/abilities/morphling/morphling_waveform.mp4">
    </video>
</div>
<h2>Area Target Spell</h2>
<p>Area target abilities work like point target abilities, with the only difference being that they require the caster to target a whole area, instead of a point. Upon pressing such a spell's button, the cursor turns into a targeted area indicator
    which shows the area the ability will affect. Upon cast, these abilities usually affect the whole targeted area, or all units in the area. Some apply their effects once upon cast, and some apply a lasting effect which affects units which enter
    the area after cast.</p>
<div class="article_video">
    <video autoplay controls loop muted poster="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/abilities/faceless_void/faceless_void_chronosphere.jpg">
        <source type="video/webm" src="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/abilities/faceless_void/faceless_void_chronosphere.webm">
        <source type="video/mp4" src="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/abilities/faceless_void/faceless_void_chronosphere.mp4">
    </video>
</div>


<h2>Vector Targeting</h2>
<p>A vector targeted spell requires two locations to be chosen. The first location determines the starting location of the spell, while the second location determines the direction. </p>
<div class="article_video">
    <video autoplay controls loop muted poster="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/abilities/dark_seer/dark_seer_wall_of_replica.jpg">
        <source type="video/webm" src="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/abilities/dark_seer/dark_seer_wall_of_replica.webm">
        <source type="video/mp4" src="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/abilities/dark_seer/dark_seer_wall_of_replica.mp4">
    </video>
</div>
<h2>Target Unit</h2>
<p>Target unit abilities require the caster to directly target a unit, and cannot be used on the ground. Upon pressing an ability's Hotkey, the cursor turns into a crosshair that determines on which unit the ability will be cast on. Most unit
    targeted abilities affect only the target. Abilities that apply their effect to a single unit are often called "single target abilities". When targeting a unit out of cast range, the caster follows the unit until it gets in cast range or the
    target cannot be targeted anymore (e.g. the target turns invisible).</p>
<div class="article_video">
    <video autoplay controls loop muted poster="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/abilities/lina/lina_laguna_blade.jpg">
        <source type="video/webm" src="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/abilities/lina/lina_laguna_blade.webm">
        <source type="video/mp4" src="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/abilities/lina/lina_laguna_blade.mp4">
    </video>
</div>

<h2>Target Unit with Area Effect</h2>
<p>A few single-target abilities have an effect which affects an area around the primary target. Like unit targeted abilities, these must be directly cast on units, and cannot be cast freely on any area. </p>
<div class="article_video">
    <video autoplay controls loop muted poster="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/abilities/winter_wyvern/winter_wyvern_winters_curse.jpg">
        <source type="video/webm" src="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/abilities/winter_wyvern/winter_wyvern_winters_curse.webm">
        <source type="video/mp4" src="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/abilities/winter_wyvern/winter_wyvern_winters_curse.mp4">
    </video>
</div>

<h2>Target Point or Unit</h2>
<p>Some point targeted abilities may also be able to directly target a unit. In such cases, the spell is cast towards the targeted unit's current location. If the target unit is out of cast range, the caster follows it until it is within range and
    casts the spell on the unit's position. Even when the target moves during the cast animation, the spell is still cast on it, or launched towards it if it is a traveling effect. This does not cause the spell's actual effects to home in on the
    target.</p>
<div class="article_video">
    <video autoplay controls loop muted poster="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/abilities/furion/furion_sprout.jpg">
        <source type="video/webm" src="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/abilities/furion/furion_sprout.webm">
        <source type="video/mp4" src="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/abilities/furion/furion_sprout.mp4">
    </video>
</div>
