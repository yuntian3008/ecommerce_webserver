export default function ({ $auth, redirect }) {
  if (!($auth.hasScope('read-orders') && $auth.hasScope('read-order-items')
    && ($auth.hasScope('read-order-items') || $auth.hasScope('read-order-items')))
    //
  ) {
    return redirect('/')
  }
}
