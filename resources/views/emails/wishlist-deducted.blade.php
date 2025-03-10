<h2>Wishlist Contribution Notification</h2>
<p>Dear User,</p>
<p>Your monthly contribution of {{ $amount }} DH for {{ $wishlist->item_name }} has been processed.</p>
<p>Current progress: {{ $wishlist->saved_amount }} DH / {{ $wishlist->estimated_cost }} DH</p>
@if($wishlist->status === 'completed')
<p>Congratulations! You've reached your saving goal for this item!</p>
@endif
<p>Keep going!</p> 