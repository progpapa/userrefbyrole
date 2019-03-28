DESCRIPTION
===========

This module allows to conifgure entity reference fields to limit user selection to only certain roles.

USAGE
=====

When configuring an entityreference field, select 'User' as target type, then in the 'Entity selection
' fieldset choose 'Search users of selected roles' as 'Mode'.

Checkboxes should show up where you can narrow the possible user references for that field by role.

WARNING
=======

No validation for the selected roles is done!
For autocomplete fields it's possible to manually enter a user (e.g. in "USERNAME (uid)" format) that doesn't have the selected role and the value will be saved.
