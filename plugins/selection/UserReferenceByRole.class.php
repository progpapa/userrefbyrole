<?php

/**
 * Allows to only select users of given roles.
 */
class UserReferenceByRole extends EntityReference_SelectionHandler_Generic_user {

  public static function getInstance($field, $instance = NULL, $entity_type = NULL, $entity = NULL) {
    return new UserReferenceByRole($field, $instance, $entity_type, $entity);
  }

  public static function settingsForm($field, $instance) {
    $form = parent::settingsForm($field, $instance);
    $form['roles'] = array(
      '#type' => 'checkboxes',
      '#title' => t('Roles'),
      '#description' => t('Filter users by role'),
      '#options' => user_roles(TRUE),
      '#default_value' => empty($field['settings']['handler_settings']['roles'])
        ? array() : $field['settings']['handler_settings']['roles'],
      '#weight' => 0,
    );
    return $form;
  }

  public function entityFieldQueryAlter(SelectQueryInterface $query) {
    parent::entityFieldQueryAlter($query);
    $roles = array_filter(array_values(
        $this->field['settings']['handler_settings']['roles']));
    if (!empty($roles)) {
      $query->join('users_roles', 'users_roles', 'users_roles.uid = users.uid');
      $query->condition('users_roles.rid', $roles, 'IN');
    }
  }
}
