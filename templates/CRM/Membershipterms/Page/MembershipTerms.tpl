<h3>{ts 1="Membership Periods"}%1{/ts}</h3>
{if $membership_terms|@count gt 0}
    <table>
        <tr>
            <th scope="col">
                {ts 1="Start Date"}%1{/ts}
            </th>
            <th scope="col">
                {ts 1="End Date"}%1{/ts}
            </th>
            <th scope="col">
                {ts 1="Contribution"}%1{/ts}
            </th>
        </tr>
    {foreach from=$membership_terms item=membership_term_item name=membership_term}
        {assign var=index value=$smarty.foreach.membership_term.index+1}
        <tr class="{if $index % 2 eq 0 } even-row {else} odd-row {/if}">
            <td class="">
                {$membership_term_item.start_date}
            </td>
            <td class="">
                {$membership_term_item.end_date}
            </td>
            <td class="">
                {assign var="query" value="reset=1&id=`$membership_term_item.contribution_id`&cid=`$membership_term_item.cid`&action=view&selectedChild=membershipterms&context=membershipterms"}
                <a class="membershipterms-view-contribution" href="{crmURL p='civicrm/contact/view/contribution' q=$query}" class="action-item crm-hover-button" title="{ts 1="View" 2="Contribution"}%1 %2{/ts}">{ts 1="View"}%1{/ts}</a>
            </td>
        </tr>
    {/foreach}
    </table>
{else}
    <div>No membership terms found for the contact {$contact.display_name}</div>
{/if}