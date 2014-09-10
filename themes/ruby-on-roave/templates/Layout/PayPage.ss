<% require javascript('https://js.stripe.com/v2/') %>
<% require themedCSS('pages/PayPage') %>
<section class="pay">
    <div class="inner">
        <h1>$Title</h1>
        $FormCreateCustomer
    </div>
</section>
<script type="text/javascript">
    Stripe.setPublishableKey('$PublishableKey');
</script>
