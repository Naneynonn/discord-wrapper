### Get Answer Voters

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `message_id` | `string` |
| `answer_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$poll = $api->poll->getAnswerVoters(channel_id: 'channel_id', message_id: 'message_id', answer_id: 'answer_id');
```

### End Poll

#### Properties

| property | type |
|----------|------|
| `channel_id` | `string` |
| `message_id` | `string` |
| `cache_ttl` | `?int` |

#### How to use

```php
$poll = $api->poll->endPoll(channel_id: 'channel_id', message_id: 'message_id');
```

