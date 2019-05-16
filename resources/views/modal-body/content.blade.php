@if ($type == 'services')

    @if(isset($service))
        @foreach ($service as $service_list)
        <h4>{{ $service_list->service }}</h4>
        <p>{!!  $service_list->description !!}</p>
            {!!  $service_list->service_readmore !!}
        @endforeach
    @endif

@elseif($type == "services_read" )

    <h4> Convenient: </h4>
    <p> Whether you’re wanting regular procedures in your own area or looking for a last minute appointment whilst traveling,
        Link Aesthetics enables you to arrange appointments at your own home, or at your provider’s location.
    </p>
    <h4> Professional: </h4>
    <p> Link Aesthetics connects you to certified health care professionals with specialisms in a wide variety of aesthetics procedures.
    </p>
    <h4> Affordable: </h4>
    <p> Compare prices, read testimonials, and enjoy great deals and discounts.
        Link Aesthetics brings together freelance providers from across the country to offer an affordable alternative to clinics and salons.
    </p>
    <p>We pride ourselves in gifting this experience to people as self-care and love is a critical part of well-being.
        By giving someone the opportunity to focus on this, they can better serve not only themselves, but others.
    </p>
@elseif ($type == 'about')

     {!! $about->about_readmore !!}

@elseif ($type == 'blog')

        @if($blog_type == 'EyeTrend')
<h4>CoolSculpting: The Fat Reducer
</h4>
            <p>Body fat, mummy tummies, muffin tops, love handles, double chins and the likes can be incredibly difficult to shift, despite trying the latest fad diet or exercise. What if we could tell you it’s possible in less than an hour? CoolSculpting is a treatment that is instantly noticeable and long lasting. Spotted in the brochures of leading spas and clinics, glossing the pages of beauty and fashion magazines, but what exactly does it do and how does it help turn back the clock? </p>
            <p>Targeting unwanted fat from different areas of the body, from love handles to double chins, the stomach to thigh fat, this procedure cryolipolysis uses the concept of cold temperature freezing and eliminating pockets of fat cells. It safely delivers precisely controlled cooling to fat cells beneath the skin; the targeted cells crystallises then shrivel and die over the coming weeks, your body then metabolises this and disposes of them naturally.
            </p>
            <p>Discovered by two Harvard scientists who made the observation and started looking into the effect cold has on fat when they noticed children getting dimples after eating popsicles. They realized the icy treats were freezing pockets of fat cells. A process that could remove unwanted fat without damaging the skin was born.
            </p>
            <p>CoolSculpting is considered to be a trusted procedure amongst the likes of Dr Edward Fruitman, Founder of Trifecta Med Spa, New York. Acknowledged as “the most successful non-surgical fat removal treatment for many reasons, mainly because it works, on average patients lose 25-30% of fat in the treatment area. Also, it’s quick – it’s only a 35 min lunchtime procedure- painless and has no downtime”.
            </p>
            <p>The appropriate candidate for the procedure, ideally have to be those who eat a healthy diet and exercise; they need to have subcutaneous fat, which is grabbable or pinchable fat to ensure effectiveness and maximum results. It can also be used for curvier patients to reduce the fat throughout a weight-loss lifestyle programme.
            </p>
            <p>Results can show from 3 weeks with optimum results at 12 weeks and a post review is necessary to ensure the procedure reached maximum effectiveness. The process offers long lasting results because the body permanently gets rid the fat cells. And since it is non-surgical, there is no downtime. Patients can resume their normal activities immediately after their treatment.
            </p>
            <p>Reshape, redefine and re-contour your body non-surgically with little down time. For more information or to book a consultation, get in touch today to find out how we can help you. </p>
        @elseif($blog_type == 'Save')
<p>Jane Iredale’s Lemongrass Love Hydration Spray is a soothing facial spritz with a lemony scent and ideal for all skin types. Formulated to hydrate, protect and condition skin, it is the perfect handbag staple for the summer. Minimising oiliness and pore appearance, celebrities swear by this product. Free from parabens and ECCOCERT – certified natural and organic, it has been proven to help minimise excess shine and the appearance of pores, as worn by actress Carice van Houten in Game of Thrones.
</p>
<h4>Key ingredients in Lemongrass Love:</h4>

<ul>
    <li><p>Aloe Leaf Juice</p></li>
    <li><p>Lemon Grass Oil and Lemon Grass Extract</p></li>
    <li><p>Chamomile Flower Extract</p></li>
</ul>

<h4>Why Invest?</h4>

<ul>
    <li><p>Minimises the appearance of pores and keeps oiliness in check &nbsp;</p></li>
    <li><p>Hydrates, conditions and protects all skin types leaving skin looking refreshed and smooth</p></li>
    <li><p>A boost of hydration that reenergizes and awakens the senses &nbsp;</p></li>
    <li><p>An instant pick-me-up that relieves symptoms of jetlag and stress &nbsp;</p></li>
    <li><p>Created without the use of parabens, sulfates and phthalates &nbsp;</p></li>
    <li><p>Certified ECOCERT Natural &amp; Organic</p></li>
    <li><p>Revives &amp; refreshes</p></li>
    <li><p>Calms and soothes</p></li>
    <li><p>Reduces dryness, redness, itching and sensitivity &nbsp;</p></li>
</ul>


        @elseif($blog_type == 'Skin')

<h4>Gwyneth Paltrow</h4>

<p>Gwyneth Paltrow attributes the cleaning solution as &quot;the best make-up remover&quot;. She explains, &quot;it&#39;s unscented, doesn&#39;t dry your skin or sting, and gets rid of all your make-up with a few swipes. You&#39;re left with soft, clean skin.&quot;</p>

<p><strong>Bioderma Sensibio H2O Micellar Water, &pound;7.82</strong><br />
    Before Amal Clooney graces the red carpet, make-up artist Charlotte Tilbury preps the star&#39;s skin with her dry sheet mask, which reduces wrinkles, smooth, brighten, lift and hydrate the skin. No need for foundation here.</p>

<p><strong>Charlotte Tilbury Instant Magic Facial Dry Sheet Mask, &pound;18</strong></p>

<p><strong>Priyanka Chopra</strong><br />
    Actress Priyanka uses the luxe 111Skin Bio-Cellulose Facial Treatment Mask to prime her skin. As mentioned in People Style, Chopra&nbsp;said she uses it&nbsp;daily:&nbsp;&quot;It&#39;s the first thing that goes on my face before any make-up, and it makes anything I put on after look flawless.&quot; This is more on the high end of skin rituals but perhaps one that makes for complexion perfection.</p>

<p><strong>111Skin Bio-Cellulose Facial Treatment Mask, &pound;85</strong><br />
    <strong>Gal Gadot</strong><br />
    With La Mer being a brand recently back on everyone&rsquo;s minds due to their London pop up events, it is no wonder their classic products are a favourite with Gal Gadot. Refreshingly light and a trusted product, Gadot is a fan of their Cleansing Oil and moisturiser. &quot;Before I go to bed, I take off all my make-up with La Mer Cleansing Oil and moisturise my face.&quot;<br />
    <strong>Cr&egrave;me de la Mer - The Cleansing Oil, &pound;65</strong></p>

@elseif($blog_type == 'Game')


        <p><strong>Facial Slimming</strong> is now possible and you can easily blitz your baby fat with Radiolysis Facial Slimming, which is an entirely safe&nbsp;non-surgical face slimming&nbsp;treatment&nbsp;which uses micro-needles to&nbsp; &#39;melt&#39; the fats in your face&nbsp;by applying radiofrequency waves into the fatty deposits. As the fatty tissues are broken down, your body will drain them naturally from the circulatory system. Voila - a youthful, slimmer face is now yours all in a short time.</p>

        <p>
            <strong>Cellfina</strong><br />
            Our obsession to achieve the perfect bum reminiscent of Kim K has led to seeking non-surgery alternatives. The first FDA-approved minimally invasive cellulite procedure to target bottom and thigh dimples, Cellfina claims to reduce the appearance of &#39;orange peel&#39; skin by 90%. Unlike other procedures, Cellfina treats the structural cause of cellulite, breaking up networks of connective tissue bands that can lead to puckering on the skin&#39;s surface. A session takes just 45 minutes and can last for up to three years.</p>

        <p>&nbsp;</p>

        @endif

@endif